Robotic arm control system.

The system allows the user to change the values of 6 engines that are used in the robotic arm and run the arm or stop it. Furthermore, it allows the user to view the current values of the engines and the status of the arm (On / Off). The values are stored in a MySQL database. Moreover, it allows the user to move the base of the robotic arm to the (right, left, forward. backward) or to stop by using the control buttons at the beginning of the page. It also displays the last instruction executed as a text placed after “Show current flow of instructions” button.  “Show current flow of instruction” button allows the user to see their recent executed instructions in a separate page by using PHP sessions. 
Description of files:

index.php file:
This is the main page of the website, and it is divided into 2 parts (Base control, and arm control).
Base control: It has 6 buttons, and 5 of them are control buttons.

1.Forward: To move the base forward.

2.Left: To move the base to the left.

3.Right: To move the base to the right.

4.Backward: To move the base backward.

5.Stop: To stop the base.

6.Show current flow of instructions: To show the last instructions executed by the user in a separate page using PHP sessions.

Arm control: it displays 6 sliders that have the range (0-180) and 3 buttons:

1.Save: To store the new values of the engines.

2.Run arm / Stop arm: To change the status of the arm.

3.Show current values: To show the current values in a table. 

Initially when the page is loaded, the current values of the engines are retrieved from the database and shown in the range slider, and the status of the arm is retrieved, and the status button is changed accordingly. For example, if the status is on the button’s value is “Stop arm”.

sliderValue.js file:
This JavaScript file displays the current value of the slider in real time.
startConnection.php file:
This file is used to connect to the database and is used to avoid repetition in the code.

run.php file:
This page is opened when clicking “Run arm” / “Stop arm” / “Show current values” buttons. 
When “Run arm” / “Stop arm” is clicked, the status of the arm is changed accordingly. The table of the current values is displayed afterwards. Moreover, there is “Go back” button which when clicked redirects the user to “index.php” page.
showInstructions.php file: 
This page is opened when clicking “Show current flow of instructions”. It retrieves the instructions that are stored in the session variable and display them. 
styles.css file:
A custom style on top of bootstrap to make the page look better. 

Design of the database:

There are two table:
Base table: has 3 columns (id, actionType, and time). id is a unique identifier for each action. actionType can have 5 values based on the action: “s” represents stop, “r” represents right, “l” represents left, “f” represents forward, and “b” represents backward. time stores the current time. 
main table:  has 7 columns. For each engine there is one column and an extra column used to store the current status of the device as Boolean. If the status is on, the value is true, otherwise it is false. The website uses only one row and updates it each time a new value is changed.

How to run the files:

-Download XAMPP or any equivalent software to run MySQL and PHP.

-Import the database “robotarmcontrol.sql”.

-Open “startConnection.php” file and change the values of the variables “$servername”, “$username”, “$password”, and “$dbname” according to your settings.
