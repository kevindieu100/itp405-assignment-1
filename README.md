# itp405-assignment-1
ITP405 Assignment #1: DVD Search Using PDO and INNER JOINs

Create search and results pages for DVDs using the dvd database named dvd. Name your search page index.php and your results page dvds.php.

## The Search Page - index.php
Your search page should have a search field for the dvd_title field using an HTML input of type 'text'.
This page should submit to dvds.php using the GET method
The Results Page - dvds.php
Fetch results from the database using PDO. Also, when joining tables, use the INNER JOIN syntax. Your results page should display what the user searched, like this:

"You searched for 'fast':"

Display the following fields on the results page in divs or an HTML table.
..*title
..*genre
..*format
..*rating
Also, be sure to use the LIKE operator so that if I type in "Die" in the search form, all movies that contain "Die" in the title will show up (like Die Hard). If no results are returned from the query, display a message to the user saying Nothing was found with a link back to the search page (index.php).

If a user navigates to dvds.php directly without any query string data, redirect back index.php.

##The Rating Page - ratings.php
Next, make each rating in the list of DVDs on the DVD results page a link to ratings.php. This page should show all dvds for the particular rating. Hint, pass the rating from dvds.php to ratings.php through a query string variable, such as:

<a href="ratings.php?rating=R">View other R rated movies</a>

You will have to do some string concatenation instead of hardcoding "R" live I've done here.