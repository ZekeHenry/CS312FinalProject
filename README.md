# CS312FinalProject

General Requirements
You will create a web page for a fictitious company, including a name and logo.  You must have a homepage with a modern design that includes basic welcome information and contains useful links to get to the other pages on the site.  You must also have an "about" page where you list the names and a brief biography of each group member.  A picture or graphic avatar is required for each member of your team

On the third page, you will have the color coordinate generation.  More details on this, below in the "Color Coordinate Generation" section

Your web page must also be styled, You will need to have at least 3 unique colors displayed on your website, NOT including pure black or white. Additionally any colors used to display text over one color or another must meet the WebAIM accessibility test, your colors chosen for displaying text or acting as a separator between two elements have a contrast value of AT LEAST 7. You can use a comment in your style sheet to include this data and can use this link to check your contrast values (https://webaim.org/resources/contrastchecker/)Links to an external site.

In General, most color palettes usually have 5-7 colors beyond pure black and white so you should try and strive for that as your target for design.

Color Coordinate Generation
This page is a page where it behaves differently if it receives URL parameters. 

In some way your code must take 2 inputs. One for number of Rows & Columns, 1 number, and a second input for number of colors. Rows & Columns must be between 1 and 26, color should be between 1 and 10. Your code must validate these values in some way, meaning that it displays a Meaningful error message if the inputs are invalid. Each set of data should be validated separately and you could have up to 2 different error messages displayed if both values are in error.

If the values pass validation, the color coordinate generation page renders a page with two tables. Note you can do this in multiple ways and even using separate tools such as Javascript, JQuery, Ajax, PHP, whichever works best for your team!

The first (upper) table is a 2 column by x row table, where x is the number of colors indicated by the parameter "colors". The left column is 20% of the table width and the right column is 80%.  The table spans most of the width of the page.  There is no header row on this table.

Below that table is a table that is n+1 x n+1 where n is the indicated row/column size.  This table is always square. All cells should have an equal height and width.

The upper-leftmost cell is empty.  The remaining cells across the top are lettered with capital letters in alphabetical order starting with "A" and going to "Z" (using "Z" for the max size of 26).  The cells in the leftmost column are numbered starting in the second row with "1" and numbering each row consecutively.

Now, in the top table, each of the left column cells has a drop-down with 10 color names (red, orange, yellow, green, blue, purple, grey, brown, black, teal).  Order these in an intuitive way for the user.  Initially, a different color is selected in each drop down.  No two drop downs can select the same color at the same time (if this happens, revert the most recently changed drop down to the previous value that was selected.  Inform the user of this in a non-intrusive way (i.e. not an alert() ).

At the bottom of the page, there is a button.  Pressing this button will take the user to a "printable view" of the resulting tables.  This should have all of the same dimensions as selected and should easily print on one page of 8.5" x 11" paper in portrait mode.  It should render in greyscale and include a greyscale logo and company name as a header.  The selected color names will appear in the cells where the drop downs were, but as plain text.  Note that this is a separate page NOT the print menu, you will only receive half points if this opens the print menu instead of rendering a new page.


PART 2

Milestone 2 builds on Milestone 1.  Your first step is to complete Milestone 1 if you have not already.

Finishing the Color Coordinate Generation
Beside each dropdown, add a radio button so a current color can be selected.  Defaults to the color in the first row.

When a cell in the lower table is clicked, it is colored with the selected color.  

When a cell in the lower table is clicked, its coordinate is added to the right column by the color name.  For example, if cells A1, B2, and C3 are colored "red" then the row with "red" as the selected color will show "A1, B2, C3" in the right cell.  Keep the cells in lexicographic order (Sort by letter First, Number Second).  

When a drop-down is changed to a new color (assuming it is valid and doesn't revert), all of the cells in the table change from the old color to the new color.  

Print View
Update the print view to support the new color coordinate generation.  When the form is submitted, the print view behaves as before.  Additionally, the radio buttons are NOT shown and along side the color name include the color's Hex Code.  The lower table's cells remain blank (white) and are not colored.  The right column of the upper table does contain the cell coordinates.

The idea here is that we have generated a "color by coordinate" sheet, where you can make a picture in the editor, then get a print view, print it and it is an activity to be colored. 

Why did we do this?
A large part of Computer Science is helping people, improving quality of life.  These color coordinate sheets are actively used in Vision Therapy for certain vision disorders.  You just make software to help with this type of therapy!  Nice.

Database - Manage Colors
Create a new tab on your page for Color Selection.

On this page you will have code to allow users to enter new colors into your selection choices. 

In your database you will add a table called "colors", each row represents a unique color. The colors have an "id", "Name", and "hex value". All 3 of these are Unique and cannot be "Null"

On this page there should 3 Interfaces. The first interface is to Add a new color, ideally the user should only have to enter a name and hex value for the color. If adding a color would conflict with an already existing name or hex value, a non-intrusive error should be displayed telling the user so. The second interface is to allow the user to Edit an existing color. This should allow them to change the name and/or the hex value of the color. The same errors apply to the Add command. Lastly there should be an interface for deleting a color. This should allow the user to select a color, and submit it for deletion. Ensure that this is a 2 step process to prevent any accidental deletes (e.g. don't use a drop down menu that sends a delete request on click).  Lastly do not let the user submit a delete request if there are less than 2 colors in the color table. Please use a non-intrusive error to alert the user if they attempt to delete one of the last 2 colors.

Please pre-initialize your table with the 10 basic colors as per milestone 1.

In the Color Generation page there are a few new changes. 1st, instead of having a drop down menu with 10 hard coded color choices it now has 1 choice per color in the Colors Table. The same color selection restrictions are in place, each row should be a unique color and no duplicate colors can be selected.

For input validation the user now can request between 1-N row for the color selector where N is the number of colors in your colors table.

Note: This will require you to create dynamic CSS styles in a stylesheet, generated by PHP.

Final Polish
Do a final polishing pass on your site to make sure it always looks its best.  This is subjective.  Do some "hallway usability testing" on your site.  Show it to your parents, aunts, uncles, cousins, children, friends, roommates, grandparents, or whoever else will look at it.  See what they say.  You want this to be a professional looking site.  Also, the print view should almost always print on one page.

Grading
Ability to paint with a chosen color, coordinate appears in table when painted (10 points)
Cells change colors when drop down changed (10 points)
Print view shows coordinates, no colored-in cells (10 points)
DB Access Page (10 Points)
DB table added to store colors, application pulls from table to populate drop downs (10 points)
User interface to add/delete colors (10 points)
User Interface to edit colors (10 points)
Final Polish, app is a well-polished, good looking, application without errors (30 points)
This is a large category and basically will be an overall impression of your site.  
Most of the submissions to Milestone 1 would have received 15-20 points on this (so don't stress too much!).
Features that aren't implemented won't count against, but if something is implemented, it should work nicely.
Milestone 2 Team Report (+10 EC)



