# personal-laravel-app
Laravel + Filament + Dockers project.

# About project
This project is created for learning purpouses. Main point is to created scaled system for Albion Online Api.

First point is to get all users info when prompted,
Second is to get all guilds info,
Third is to generate pdf with player stats,
4th is to track user guild info - members, events, all of it,

Whats next?

We will se what api gives, I would like to check more player stats, but I am afraid, that Api dont serve this. 
If I get all of those I would like to test other apis

# Technology stack

- Laravel 12.x
- Filament 5.x
- Redis
- Livewire
- Maybe Vue, but Livewire is good enought to not complicate project development
- Volt (Vue-like blade components typing)
- maybe more

# Why laravel?

Laravel is one of the most popular framework for webservice. Gives speed of programming with blade coding + optimized environment

# Why Filament?

Filament is the easiest way to build panel oriented webservices. I can easly work with tenants for tons of objects. Users, Guests, Admins, where I can easly change theme and change visuals of website. Plus it gives tons work ready components like forms, lists etc.

# Redis 

Redis is to cache api responses for fast and safe working. We wont get blocked by api services.

# Livewire

Livewire is very strong language that works excelent with blades. I could use vue, but I think that this project dont need this. This is easiest to manage project

# Volt 

Volt changing blade typing, that gives this what give Vue. One file - controller and html in the same place. Excelent for short mechanics.

# Horizon

This will be tested for queues. Will be useful for api responses to keep alive requests if ned.
