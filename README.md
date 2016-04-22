# XDCC-simple

# What this xdcc list can do?
You can see what this website do by [watching the todo list](TODO.md)

## Why another XDCC Parser?

- Because [XDCCParser-global](https://github.com/nitmir/XDCCParser-global) is bugged
- Because [my fork](https://github.com/Kcchouette/XDCCParser) is less bugged; but isn't **responsive** (mobile) and use Text File from Iroffer
- Use **XML file** from Iroffer
- No Database
- No Composer or other things
- Minimalist CSS (with [OMGCSS](https://fabienwang.github.io/omgcss/))

## Requirements:

- XML File from Iroffer (remove the `#` from `#xdccxmlfile mybot.xml` [here](https://github.com/dinoex/iroffer-dinoex/blob/master/sample.config#L108))
- PHP (I develop it using PHP7.0, so I think >= 5.0 is ok)

## How to use it?

1. Edit the `config.php` file and set: `$user="";` and `$password="";` for the admin page
2. Add your bot on the `admin.php` page (the `name` of your bot must be UNIQUE!)
2. Finish :)
