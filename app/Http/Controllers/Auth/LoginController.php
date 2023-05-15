<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginCustom(Request $request)
    {
        // Validation des champs email et password
        $this->validate($request, [
            'courriel' => 'required|email',
            'password' => 'required',
        ]);

        //Dand le cas si on utilise le remember me fonctionaliter sur la page de login 
        //$remember = $request->has('remember'); //vérifier si l'utilisateur a coché le checkbox "Remember me"


        // Récupération de l'utilisateur par l'adresse email
        $user = User::where('courriel', $request->courriel)->first();

        // Vérification si l'utilisateur existe et est actif
        if (!$user) {
            // Si l'utilisateur n'existe pas ou n'est pas actif, redirection vers la page de connexion avec un message d'erreur
            return redirect()->back()->withErrors(['courriel' => 'Les informations de connexion sont incorrectes ou votre compte n\'est pas actif.']);
        }

        //si on utilise le remember me ajouter $remember comme 3em argument
        // Si l'utilisateur existe et est actif, tentative de connexion avec Auth::attempt()
        if (Auth::attempt(['courriel' => $request->courriel, 'password' => $request->password])) {

            // Si la connexion réussit, création de la session cookie
            $cookieValue = encrypt($user->id . '|' . $user->courriel);
            Cookie::queue('myapp_session', $cookieValue, 60 * 24 * 30); // Cookie will expire in 30 days

            // si on utilise remember me ...pour passer le variable remember sur la page blade ..->with('remember', $remember)
            // Si la connexion réussit, redirection vers la page d'accueil
            return redirect('/celliers');
        }

        // Si la connexion échoue, redirection vers la page de connexion avec un message d'erreur
        return redirect()->back()->withErrors(['courriel' => 'Les informations de connexion sont incorrectes.']);
    }
}
