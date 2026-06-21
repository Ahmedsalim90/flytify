# BrochoMaker 

> BrochoMaker is a platform on which you can easily create flyers for your events, your personal brand and even holdup for your events without any stress. 


---

## What is the project all about 

What is the use of this project 

BrochoMaker is an online platform that many user access to create their flyers 
and all hold-ups for your events and your personal brand setup for your personal professional development.

---

## How it works 

- **Index.html** When you access the platform the first page loading is the index.html.
The you have a brief description of the platform and some models.With a button try this taking you to the 
test.html. and also you have a nav link taking you to the same page.
- **test.html** Here you have the variety of models that you can use. A form that you have to
fill for your informations having placeholders to guide users. Then you select your brand colors,
primary and secondary. After you upload your logo having a preview of the choosen logo and a button generate my brochure.
- **generate.php** For the generate.php it is the file in charge of creating your brochure you see it then you have 
two button download PDF and a create another. clicking on download PDF it permits you to download in your local computer.
- **database.php**  Here is the database in relation with PHPMYADMIN used to save the data and the brochure. Brochures
that are already created are displayed on the gallery of the platform and is displayed on the users device.  



### `index.html` - Landing page

This is the first thing visitors see. It explains what the service does and shows off available templates.


### `test.html` - Builder page

This is where users pick a template and fill in their information. It contains:
- Radio buttons to select a model (template)
- Text fields for name, company, tagline, email, phone
- Colour pickers for brand colours
- A file upload for their logo


### `assets/css/style.css` - Stylesheet

Controls how everything looks. Colours, fonts, spacing, layout.


### `assets/js/script.js` - JavaScript

Makes the page interactive. Currently has ONE working feature: the primary colour preview updates live when you pick a colour.


### `models/model1.html` and `model2.html` - Brochure templates

These are the brochure designs. Replace them with your own HTML designs.

**Important:** Keep the `{{PLACEHOLDER}}` tags. These are markers that get replaced with the user's actual data. For example:

```html
<h1>{{COMPANY_NAME}}</h1>
<p>{{TAGLINE}}</p>
```

Available placeholders:
- `{{FULL_NAME}}` - User's name
- `{{COMPANY_NAME}}` - Their company
- `{{TAGLINE}}` - Their slogan
- `{{EMAIL}}` - Email address
- `{{PHONE}}` - Phone number
- `{{PRIMARY_COLOR}}` - Primary brand colour (hex)
- `{{SECONDARY_COLOR}}` - Secondary brand colour (hex)
- `{{LOGO_PATH}}` - Path to their uploaded logo

**To add a new template:** Copy `model1.html` to `model3.html`, replace the content with your own design, add it to the model selector in `test.html`.

### `config/schema.sql` - Database blueprint

Explains why a database is needed and provides an incomplete SQL table. Your job is to add the missing columns then import it into phpMyAdmin.

### `hint.php` - Code hints

A collection of commented-out PHP snippets. Nothing runs. When you're ready to build `generate.php`, open this file and use the snippets as a starting point.

### `.env.example` - Environment template

Contains placeholders for database connection settings. You copy it to `.env`, fill in your actual details, and PHP reads it from there.

**Why not just write the credentials directly in the code?** Because if you share your code on GitHub (and you will), everyone would see your database password. The `.env` file is listed in `.gitignore` so it never gets uploaded. Only `.env.example` (which has no real passwords) is shared.

---


---

## Environment Variables (.env)

The `.env` file stores settings that change depending on where the project runs:

| Variable | What it is |
|---|---|
| `DB_HOST` | Database server address (usually `localhost`) |
| `DB_NAME` | The name of your database |
| `DB_USER` | Your MySQL username (`root` for XAMPP/LAMPP) |
| `DB_PASS` | Your MySQL password (blank for XAMPP/LAMPP) |

**The golden rule:** `.env` never goes on GitHub. `.env.example` is the one you commit - it shows other people what variables they need to set, without exposing your secrets.

---

---

## License

GNU General Public License v3.0 - see [LICENSE](LICENSE).

---

*This brochure creator is for creating your brochures Powered by The ALCHEMIST*
