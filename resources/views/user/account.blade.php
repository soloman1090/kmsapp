@extends('templates.main-user')

@section('content')
 <!-- DataTables -->
    <div class="container ">
        <div class="margin80"></div>
        <div class="margin10 headd">
            <h2>Account Settings</h2>
            <p>user@gmail.com</p>
        </div>
        <div class="cards margin20">
            <ul>
                <li>
                    <div class="">
                        <a href="">
                            <div class="">
                                <p>ID verification	</p>
                            </div>
                            <button class="btn btn-brand-02">Done </button>
                        </a>
                    </div>
                </li>
                <li>
                    <a href="">
                        <p>Two Factor Authentication	</p>
                        <button class="btn btn-brand-02">Enabled </button>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>KYC Information	</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>Change Password</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>Privacy Policy</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>Sign out of Account</p>
                        <button class="btn btn-brand-02">Logout </button>
                    </a>
                </li>
            </ul>
        </div>
    </div>

 @endsection
