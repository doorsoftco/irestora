<p align="center"><img src="resources/iRestora_logo.png" alt="iRestora - Open Source Restaurant POS Logo" width="auto" height="80"></p>
<h3 align="center">iRestora - Open Source Restaurant POS</h3>

<p align="center">
  <a href="#-introduction">Introduction</a> · <a href="#-live-demo">Demo</a>  · <a href="#-Premium Edition">Installation</a> · 
  <a href="#-contributing">Contributing</a> · <a href="#-reporting-bugs">Bugs</a> · <a href="#-faq">FAQ</a> · 
  <a href="#-customization">Custoization</a> · <a href="#-license">License</a> · <a href="#-credits">Credits</a>
</p>


## 👋 Introduction

iRestora is a open source Restaurant POS With Smart Inventory (Multi Outlet).
<br><br><b>Buy Ingredient, sale Food Menu Ingredient Inventory updates automatically based on consumption</b>
<br><br>
The application is written in PHP, it uses MySQL (or MariaDB) as data storage back-end and has a simple but intuitive user interface.

It uses CodeIgniter 3 as a framework and is based on Bootstrap 3 using AdminLTE theme. Along with improved functionality and security.

The features include:

- Purchase 
- Sale
- Ingredient Stock with Stock Valuation
- Waste
- Expense
- Profit/Loss
- VAT
- Discount
- Restaurant tables
- KOT
- Payment Method
- Supplier Due
- Access Control
- Hold Sale
- Waste Control 
- Sale register with transactions logging
- Database of customers and suppliers
- Multiuser with permission control
- Reporting on sales, orders, expenses, inventory status and more


## 🧪 Live Demo

We've got a live version of our latest master running for you to play around with and test everything out. 

You can [find the demo here](https://doorsoft.co/demo/irestora/) and log in with these credentials.  
👤 Username `admin@doorsoft.co`  
🔒 Password `123456`

If you bump into an issue, please email us at info@doorsoft.co


## 💾 Installation

- Upload all the files to your server
- Open this file in your editor application/config/cofig.php
- Edit this line $config['base_url'] = 'http://localhost/irestora/'; with your base url like http://your-domain.com/irestora/
- Create a database named irestora
- Go to database folder
- Import irestora_blank SQL file into your database
- Open this file in your editor application/config/database.php
- Edit these three lines with your database user name, password and database name
- $db['default']['username'] = 'root';
- $db['default']['password'] = '';
- $db['default']['database'] = 'irestora';
- And finally run the project by accessing http://your-domain.com/irestora/


## 🐛 Reporting Bugs

If you find any issue please email that us at info@doorsoft.co. 
Before sending any issue to us please make sure that you are including these:
- Screenshot(using lightshot) or a video capture(using screencastify) that will explain the issue properly
- URL of the software where it is installed, login email and password
- Your server FTP and DB access


## 📖 FAQ

- PHP 8.0 is not currently supported

- PHP 5.5 and 5.6 are no longer supported due to the fact that they have been deprecated and not safe to use from security point of view.

- Apache server configurations are SysAdmin issues and not strictly related to OSPOS. Please make sure you can show a "Hello world" HTML page before pointing to OSPOS public directory. Make sure `.htaccess` is correctly configured.

- We are not offering intant free support for this script, fixes will come with next update. Instant support may be chargeable.


## 🔧 Customization

Please contact us for any customization you need.
We charge 8.5 USD per hour
Contact info:
Email: info@doorsoft.co 

## 🏃 Premium Edition

If you are looking for a premium edition of this script you can buy iRestora PLUS only at $69 from CodeCanyon.

It has lot of luxirious and useful features like: 

- It can still run even when the internet is gone. When the internet is gone it starts storing data offline and sends them online when the internet is available. 
- QR code self-ordering system 
- Ingredient Recipe management feature 
- Ingredient Stock
- Category-wise kitchen panel and KOT 
- Pre-made Item
- Item Variation
- Toppings
- Combo
- Promotion & Discount
- Loyalty Point
- White Labeled
- Multi-Currency
- Split Bill
- Multi-language
- And many more...


🔴 [Buy The Premium Edition From Here](https://codecanyon.net/item/irestora-plus-multi-outlet-next-gen-restaurant-pos/24077441) ❗🔴


## 📄 License

iRestora - Open Source Restaurant POS is licensed under MIT terms with an important addition:

The footer signature "© 2010 - _current year_ · doorsoft.co · 3.x.x - _hash_" including the version, hash and link our website MUST BE RETAINED, MUST BE VISIBLE IN EVERY PAGE and CANNOT BE MODIFIED.

Also worth noting:

_The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software._

For more details please read the [LICENSE](LICENSE) file.

It's important to understand that although you are free to use the application the copyright has to stay and the license agreement applies in all cases. Therefore any actions like:

- Removing LICENSE and/or any license files is prohibited
- Authoring the footer notice replacing it with your own or even worse claiming the copyright is absolutely prohibited
- Claiming full ownership of the code is prohibited

In short, you are free to use the application but you cannot claim any property on it.

Any person or company found breaching the license agreement might find a bunch of monkeys at the door ready to destroy their servers.

## 🙏 Credits

<h4>CodeIgniter 3 | AdminLTE | Bootstrap | jQuery | Dompdf | The Noun Project | PrettyDocs </hr>