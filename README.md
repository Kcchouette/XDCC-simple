# XDCC-simple

## What this xdcc list can do?

You can see what this website do by watching the features wiki page:
- [Feature page on the wiki](https://github.com/Kcchouette/XDCC-simple/wiki/Features)

- and the current developp branch is listed in the [TODO](https://github.com/Kcchouette/XDCC-simple/blob/master/TODO.md)


## Why another XDCC Parser?

 - Because [XDCCParser-global](https://github.com/nitmir/XDCCParser-global) is bugged
 - Because [my fork](https://github.com/Kcchouette/XDCCParser) is less bugged; but isn't **responsive** (mobile) and use Text File from Iroffer
 - Because [iroffer-state](https://github.com/dinoex/iroffer-state) use the `.state` file of the bot


This project uses:
 - **XML file** from Iroffer
 - No Database
 - No Composer or other things
 - Light CSS (using [Spectre.css](https://github.com/picturepan2/spectre))
 - Light: for `index.php` → 2 CSS (50Ko) + 0 JS (0Ko) + 1 image (2Ko) + 1 HTML (~10 Ko; depends of content) = ~**62 Ko**!


## Requirements:

 - XML File from Iroffer (remove the `#` from `#xdccxmlfile mybot.xml` [here](https://github.com/dinoex/iroffer-dinoex/blob/9cb3f8c3c4c6112068a4ac741cb32b6a0340280d/sample.config#L108))
 - PHP (I develop it using PHP7.0, so I think PHP >= 5.0 is ok)


## How to use it?

 1. Edit the `config.php` file and set: `$user="";` and `$password="";`
 2. Change others values you want from `config.php`
 3. Connect to the admin page: `admin.php`
 4. Add your bot (the `name` of your bot must be UNIQUE!)
 5. Finish :)


## Thanks

 - For the Feed icon: <a href="https://en.wikipedia.org/w/index.php?curid=33285359">https://en.wikipedia.org/w/index.php?curid=33285359</a>
