# Symfony exam CDA
This is a "Leboncoin" inspired project

This projects uses a few dependencies: 

-  [KnpPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle) -- for Pagination
-  [Webpack encore](https://symfony.com/doc/current/frontend.html#webpack-encore) -- for CSS and Bootstrap implementations
-  [Bootstrap v5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)


To use it: 

```bash

git clone git@github.com:gytar/symfony-exam.git
cd symfony-examen/
composer install
# install yarn if needed
yarn install
yarn encore dev
```
- Go and add an `.env.local` file with your Database options
- Open the local server
```bash
symfony serve -d
```
- Enjoy ! 
