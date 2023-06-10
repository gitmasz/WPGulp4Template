<h1>WordPress Gulp 4 Template</h1>

WordPress theme for development with Gulp 4.0.2 (configured for Node 18.16.0 and NPM 9.5.1) automation for optimizing css, js and images files.

<h2>Disclaimer</h2>

This template is not complete WordPress Theme. It is template for building WordPress Themes. It contains a lot of WordPress configuration functions and few CSS and JS components. It uses Gulp 4 automation for optimization and Composer for loading PHP classes. I have made this template for myself to combine useful stuff in one place and test them but if You find this template is interesting feel free to use it (it's on MIT License).

<h3>Requirements</h3>

To use this template You have to has local serwer (I recommend XAMPP) and installed WordPress. You also need Node.js and Composer. I also recommend using Visual Studio Code with extensions "PHP Intelephense", "SCSS Formatter" and "ESLint".

<h4>How to start using this template?</h4>

1. Download this repository and rename folder to Your future WordPress theme name.
2. In "./style.css" change "Theme Name", "Author" and "Text Domain".
3. Change "gulp4-theme" in "./404.php", "./index.php" on what You set in "./style.css" as "Text Domain".
4. Adjust "package.json" to Your project.
5. Install Node.js and dependencies.
6. In "gulpfile.js" change "proxy" url on line 121.
7. Install Composer and initiate autoloader.
8. Start making changes and creating Your WordPress Theme.