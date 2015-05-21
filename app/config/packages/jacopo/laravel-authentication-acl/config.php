<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Application name
  |--------------------------------------------------------------------------
  |
  | The name of the application: this name will be used as title and as header
  | in the application
  |
  */

  "app_name" => "用户管理",

  /*
  |--------------------------------------------------------------------------
  | Email confirmation
  |--------------------------------------------------------------------------
  |
  | Set this flag to true if you want to force every new user (on signup)
  | to verify his email address
  |
  */

  "email_confirmation" => true,

  /*
  |--------------------------------------------------------------------------
  | Gracefully error handling
  |--------------------------------------------------------------------------
  |
  | Set this flag to true if you want the application to handle 404 and 401
  | error pages
  |
  */

  "handle_errors" => false,

  /*
  |--------------------------------------------------------------------------
  | Login redirection url
  |--------------------------------------------------------------------------
  |
  | The user/login redirection url
  |
  */
  "user_login_redirect_url" => "/",
  /*
  |--------------------------------------------------------------------------
  | Login redirection url
  |--------------------------------------------------------------------------
  |
  | The student/login redirection url
  |
  */
  "student_login_redirect_url" => "/users",
  /*
  |--------------------------------------------------------------------------
  | Login redirection url
  |--------------------------------------------------------------------------
  |
  | The student/login redirection url
  |
  */
  "teacher_login_redirect_url" => "/gxadmin",
  
   /*
  |--------------------------------------------------------------------------
  | Backend Login redirection url --modified by gavin
  |--------------------------------------------------------------------------
  |
  | The user/login redirection url
  |
  */
  "backend_login_redirect_url" => "/backend",
  /*
  |--------------------------------------------------------------------------
  | User per page
  |--------------------------------------------------------------------------
  |
  | Set the number of users per page to show on admin users list page
  |
  */

  "users_per_page" => 15,

  /*
  |--------------------------------------------------------------------------
  | Groups per page
  |--------------------------------------------------------------------------
  |
  | Set the number of groups per page to show on admin groups list page
  |
  */

  "groups_per_page" => 15,

    /*
   |--------------------------------------------------------------------------
   | Captcha validation on signup
   |--------------------------------------------------------------------------
   |
   | Flag to enable/disable captcha validation on user signup
   |
   */

  "captcha_signup" => true,

  /*
   |--------------------------------------------------------------------------
   | Avatar
   |--------------------------------------------------------------------------
   */
  "default_avatar_path" => '/packages/jacopo/laravel-authentication-acl/images/avatar.png',
  /*
   * Set to true if you want to use the user gravatar instead
   */
  "use_gravatar" => false,
];