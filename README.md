# nodeqr

Problem Statment: https://github.com/Dineshkushwaha/sph-test/blob/main/README.md

Hosted the Solution on https://dev-nodeqr.pantheonsite.io/

Drupal Version Used for Solution : 9.3.11

Answer QR Code Block Implementation 
-----------------------------------------------------------------------------------------------

I have implemented the solution in 2 ways

1] I have used Drupal's Core module Layout Builder to Place Block on Node
-----------------------------------------------------------------------------------------------
2] I have made a use of template_preprocess_node hook to pass block content as vaiable
-----------------------------------------------------------------------------------------------

I have used PHP Library "aferrandini/phpqrcode" to generate QR image for the given link

(This Library is abonded now, but it has minimal code to generate QR)

We can also make use of Endriod Library for the same QR generation.
---------------------------------------------------------------------------------------------
I have created 1 custom Module called "product_qr_code" for Block generation

Block genration was really tricky because of its Dynamic behviour with every Node

But I found the way to get the node context using Route details and I used Purchase Link for QR generation.

-----------------------------------------------------------------------------------------------

I have also created 1 sub theme with Name "Bsub" which means BartikSub theme

This theme I created for the 2nd approach where I passed Block as variable to Hook_prepprocess_hook

-----------------------------------------------------------------------------------------------

I have used 3 contrib modules: Devel Generate, Pathauto & Admin toolbar

Devel generate - to generate a content

Pathauto for URL Alias Pattern Generation

Admin Toolbar - to Save the time of browsing the different admin links

--------------------------------------------------------------------------------------------

The Node page shows 2 QR code but those are 2 different implementations on same page.

------------------------------------------------------------------------------------------
To use this  module on your local

1] Firstly install above mentioned 3 contrib modules and PHP library using composer (My composer.json has those details)

2] Enable all 3 modules

3] Install custom Module  - **product_qr_code**

4] Install Custom theme   - **Bsub**

5] Create Content type - Products with Fields: Product Title, Product Image, Product Description and App Purchase Link

6] Generate content - Devel gernerate

7] Configure Layout for first approch impmplementation of Block

8] Use Full Page content View Mode

9] Click on Manage Layout of Full page view mode

10] Remove existing Section from layout 

11] Add new Section and use 2 col layout - 66&-33%

12] Add blocks for every field of product content type i.e. Product Title, Product Image, Product Description and App Purchase Link
 
13] Place Programatically created Custom Block block in 2nd column - 

14] Save Layout

---------------------------------------------------------------------------------------------
