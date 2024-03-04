import { Link, Head } from '@inertiajs/react';
import { FaGithub } from "react-icons/fa";
import { IoLogoGoogle } from "react-icons/io";
import "../App.css"

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    return (
        <>
            <Head title="Music | Welcom" />
            <div className="welcome-body">
                <div className="home-link">
                    {auth.user && (
                        <Link
                            href={route('dashboard')}
                            className="btn-"
                        >
                            <h1>Music</h1>
                        </Link>
                    )}
                </div>

                <div className="welcm">
                    <div className='welcm-text'>
                        <h1>Music</h1>
                        <small>We enriches lives, evokes emotions, fosters creativity, connects cultures, inspires joy, and heals souls universally.Music enriches lives, evokes emotions,
                            fosters creativity, connects cultures, inspires joy, and heals souls universally.</small>
                    </div>

                    {!auth.user && (
                        <div className='welcm-link'>
                            <a href={route('login')} className="button-o" >
                                Log in
                            </a>

                            <a href={route('register')} className="button-o" >
                                Register
                            </a>
                            <div className='logwith-block'>
                                <p>Loggin with Google | Github</p>
                                <a href={route('login')} className="button git-btn" >
                                    FaGithub
                                </a>
                                <a href={route('register')} className="button google-btn" >
                                    Google
                                </a>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </>
    );
}
