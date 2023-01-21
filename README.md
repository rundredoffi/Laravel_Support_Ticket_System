<a name="readme-top"></a>


<!-- HEADER -->
<div align="center">
    <h1 align="center">Laravel Support Ticket System</h1>
</div>


<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>


<!-- ABOUT THE PROJECT -->
## About The Project

![Project GIF Preview](https://i.imgur.com/hmvrnIo.gif)

Demo project created by myself inspired by [Demo Project Laravel Support Ticket](https://laraveldaily.com/post/demo-project-laravel-support-ticket-system). 

<p align="right">(<a href="#readme-top">back to top</a>)</p>


### Built With

* [Laravel 9.x](https://laravel.com)
* [Bootstrap 4.x](https://getbootstrap.com/)

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- GETTING STARTED -->
## Getting Started

Please check the official [laravel 9.x installation](https://laravel.com/docs/9.x) guide for server requirements before you start.

### Installation

Clone the repository

    git clone git@github.com:KidFabi/Laravel_Support_Ticket_System.git

Switch to the repository folder manually or using

    cd laravel-support-ticket-system

Copy the `env.example` file and rename it to `.env`. After that make the required configuration changes in the `.env` file
    
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=
    FILESYSTEM_DISK=local
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=
    MAIL_PASSWORD=
    
Install all the dependencies using composer

    composer install

Generate a new application key

    php artisan key:generate

Run the database migrations and seed the database with fake data

    php artisan migrate --seed
    
Run NPM commands

    npm install && npm run dev

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- USAGE EXAMPLES -->
## Usage

Go to the home url and log in as an administrator. If you ran the `php artisan db:seed` command, the credentials are:
<br/>
Email: `admin@example.com`
<br/>
Password: `password`

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- CONTRIBUTING -->
## Contributing

The project is final and thus, no Pull Requests will be merged nor reviewed. You are free to clone the repository and move on with your copy of the project.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.md` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

* [LaravelDaily blog](https://laraveldaily.com/post/demo-project-laravel-support-ticket-system)
* [Larastarters package](https://github.com/LaravelDaily/Larastarters)
* [Laravel Debugbar](https://github.com/barryvdh/laravel-debugbar)
* [Spatie activity log package](https://spatie.be/docs/laravel-activitylog/v4/introduction)

<p align="right">(<a href="#readme-top">back to top</a>)</p>
