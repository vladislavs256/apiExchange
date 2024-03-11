# apiExchange

<a name="readme-top"></a>






<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/vladislavs256/apiExchange">
    <img src="https://avatars.githubusercontent.com/u/45405871?s=400&u=6b3f9774b0dd21e79ca4fe7c2676208956f64350&v=4" alt="Logo" width="80" height="80">
  </a>

<h3 align="center">Exchange System</h3>

  <p align="center">
    Test task  

  </p>
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
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->
## About The Project


# create a PHP back-end service that captures historical currency exchange rates on a daily basis and presents them in a front-end interface.

## Mandatory Requirements:
- Back-end service: Symfony or Laravel
- Front-end interface: VueJS or React


## Additional Requirements:

- Data stored in an SQLite database. [Database file](data/database.sqlite)
- Currency changes are to be imported using following API service (free plan):
  https://anyapi.io/
- Data should be stored in SQL based database - Stored <B>postgres<B>
- Data should be refreshed with the most recent EUR to GBP, USD, AUD exchange
  rates on daily basis = Confirguret cron job
- Front-end interface should allow user to select target currency and output a view as
  illustrated in the mockup file attached (Test Assignment.jpg)





### Built With

* Symfony
* Tailwind
* Vue




<!-- GETTING STARTED -->
## Getting Started

### Prerequisites

You just need install docker to launch this project if you don't have it
* docker
  ```sh
  sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
  ```

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/vladislavs256/apiExchange.git
   ```
2. Use make start to launch docker containers and seeders 
   ```sh
   make start
   ```








<!-- USAGE EXAMPLES -->
## Usage

Server running on http://localhost:8080
Frontend running on http://localhost:8081


<!-- ROADMAP -->

[//]: # (## Roadmap)





<!-- CONTACT -->
## Contact

Email - vladislavsKudrins@gmail.com <br>

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/vladislavs256/SmallTicketSystem.svg?style=for-the-badge
[contributors-url]: https://github.com/vladislavs256/SmallTicketSystem/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/vladislavs256/SmallTicketSystem.svg?style=for-the-badge
[forks-url]: https://github.com/vladislavs256/SmallTicketSystem/network/members
[stars-shield]: https://img.shields.io/github/stars/vladislavs256/SmallTicketSystem.svg?style=for-the-badge
[stars-url]: https://github.com/vladislavs256/SmallTicketSystem/stargazers
[issues-shield]: https://img.shields.io/github/issues/vladislavs256/SmallTicketSystem.svg?style=for-the-badge
[issues-url]: https://github.com/vladislavs256/SmallTicketSystem/issues
[license-shield]: https://img.shields.io/github/license/vladislavs256/SmallTicketSystem.svg?style=for-the-badge
[license-url]: https://github.com/vladislavs256/SmallTicketSystem/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/linkedin_username
[product-screenshot]: images/screenshot.png
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Symfony-url]: https://symfony.com
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com




