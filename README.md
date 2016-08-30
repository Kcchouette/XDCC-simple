# XDCC-simple

# What this xdcc list can do?
You can see what this website do by watching the release list:
- [v0.1](https://github.com/Kcchouette/XDCC-simple/releases/tag/v0.1)
- and the current developp branch is listed in the [TODO](https://github.com/Kcchouette/XDCC-simple/blob/master/TODO.md)

## Why another XDCC Parser?

 - Because [XDCCParser-global](https://github.com/nitmir/XDCCParser-global) is bugged
 - Because [my fork](https://github.com/Kcchouette/XDCCParser) is less bugged; but isn't **responsive** (mobile) and use Text File from Iroffer

This project uses:
 - **XML file** from Iroffer
 - No Database
 - No Composer or other things
 - Minimalist CSS (with OMGCSS [(miror)](https://github.com/Kcchouette/omgcss))
 - Very Light: 2 CSS (9,41Ko) + 1 JS (0,19Ko) + 1 HTML (~10 Ko; depends of content) = **20 Ko**!


## Requirements:

 - XML File from Iroffer (remove the `#` from `#xdccxmlfile mybot.xml` [here](https://github.com/dinoex/iroffer-dinoex/blob/9cb3f8c3c4c6112068a4ac741cb32b6a0340280d/sample.config#L108))
 - PHP (I develop it using PHP7.0, so I think >= 5.0 is ok)


## How to use it?

 1. Edit the `config.php` file and set: `$user="";` and `$password="";` using to connect on the admin page
 2. Add your bot on the `admin.php` page (the `name` of your bot must be UNIQUE!)
 3. Finish :)
