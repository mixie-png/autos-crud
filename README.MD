# Autos C.R.U.D.

This repository contains the code for the web application assignment as part of the Coursera course "Building Database Applications in PHP." This assignment focuses on building a web-based application to track data about automobiles, implementing the Create, Read, Update, and Delete (CRUD) functionality.

## Assignment Description

In this assignment, I created a complete web application that encompasses multiple screens to perform CRUD operations on automobile data. This project combined various concepts covered throughout the course and served as the foundation for future web application development.

## General Specifications

Here are the general specifications and guidelines for this assignment:

1. **Data Sanitization**: Ensure that all data received from users is properly escaped using the `htmlentities()` function in PHP. This practice helps prevent security vulnerabilities like Cross-Site Scripting (XSS) attacks.

2. **POST-Redirect-GET Pattern**: Implement the POST-Redirect-GET (PRG) pattern for all POST requests. When the program receives and processes a POST request, it should not generate any HTML as the HTTP response. Instead, use the `header('Location: ...')` function along with `return` to send the location header and redirect the browser to the same or a different page. This pattern helps prevent data resubmission issues.

3. **Server-Side Data Validation**: Do not rely solely on HTML5 in-browser data validation (e.g., `type="number"`) for input fields in this assignment. Emphasize server-side data validation to ensure that data is validated on the server, even if the user's browser does not support HTML5 features. This practice enhances security and robustness.