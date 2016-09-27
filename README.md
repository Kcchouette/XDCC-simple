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

## Thanks

 - For the Feed icon: <a href="https://en.wikipedia.org/w/index.php?curid=33285359">https://en.wikipedia.org/w/index.php?curid=33285359</a>
 - For the edit icon: By Simple Icons (https://www.thenounproject.com/term/edit/31085/) [<a href="http://creativecommons.org/licenses/by-sa/3.0">CC BY-SA 3.0</a>], <a href="https://commons.wikimedia.org/wiki/File%3AEdit_Notepad_Icon.svg">via Wikimedia Commons</a>
 - For the Remove icon: By VisualEditor team - <a class="external free" href="https://git.wikimedia.org/summary/mediawiki%2Fextensions%2FVisualEditor.git">https://git.wikimedia.org/summary/mediawiki%2Fextensions%2FVisualEditor.git</a>, <a href="http://opensource.org/licenses/mit-license.php" title="MIT license">MIT</a>, <a href="https://commons.wikimedia.org/w/index.php?curid=26927469">https://commons.wikimedia.org/w/index.php?curid=26927469</a>
 - For the CSV icon: By RRZEicons (Own work) [<a href="http://creativecommons.org/licenses/by-sa/3.0">CC BY-SA 3.0</a>], <a href="https://commons.wikimedia.org/wiki/File%3AText-csv-text.svg">via Wikimedia Commons</a>