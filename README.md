# Picture This

Assignment in programming class @ Yrgo.

## Table of Contents

-   [Assignment instructions](#Assignment-instructions)
-   [Install](#Install)
-   [Preview](#Preview)
-   [Tested by](#Tested-by)
-   [Code review](#Code-review)

## Assignment instructions

### Create an Instagram clone using PHP, HTML, CSS & JavaScript.

-   As a user I should be able to create an account, sign in, sign out, create new posts, edit posts, delete posts, edit account details, add an avatar, like and dislike posts.

## Install

-   Clone repository by running the command below in your Terminal.
-   `$ git clone git@github.com:oaflindberg/Picture-This.git`
-   Start a php server with the following command
-   `php -S localhost:1337`
-   Open your browser and go to localhost:1337

## Preview

<img src="https://i.imgur.com/4eBxapb.png" width="100%">

## Tested by

- [Alexander Gustasfsson Flink](#https://github.com/alexandergustafssonflink)
- [Oskar Joss](#https://github.com/OskarJoss)

## Code Review

- Index.php - Nice work with the graphical interface! It looks really cool!!
 
- Index.php:49 - You could add a "autocomplete="off" to avoid getting suggestion.
 
- App/users/account.php:39-40 - Don't forget to both sanitize and validate the email. As of now I can update to a non valid email. And I get stuck at http://localhost:8000/app/users/account.php if I leave the "new email"-input blank or type in the wrong current email.
 
- App/users/account.php:24 - When trying to change password, if I type in the wrong current password I get stuck at http://localhost:8000/app/users/account.php. You should add an else on your if-statement.
 
- App/users/delete.php: - You should also unlink the post images from /uploads/posts.
 
- App/users/delete.php:15 - Right now the unlink of the avatar image is not working properly. The folder is named upload/avatar but in the code you've written upload/avatars. A minor typo, which is easily fixed!
 
- Functions.php: Don't forget to write the type in your parameters! :)
 
- Functions.php:116 &. 120 - When you use this function in ex. account.php:38 you're sending the user-id as a parameter but you're not using it in the function. You could either skip the parameter $userId and just write $_SESSION['user']['id'] directly, like you aldready have. Or change line 120 (in functions.php) to $userId to prevent from repeating yourself.
 
- Main.css:14-20 - This is merely a suggestion!! Instead of using an img-tag for the backgrounds, you could use the background-image property in CSS which automatically stays in the background and is easier to handle! :)

- It's currently possible to update avatar without actually adding a file. 

Code review by [Betsy Alva Soplin](#https://github.com/milliebase)

