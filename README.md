# site
voluntaryist.com website

Commit [f2fe7fa](https://github.com/voluntaryist/site/commit/f2fe7faff6dcc9f248306a84eddcfaf34af3df3e#diff-828e0013b8f3bc1bb22b4f57172b019d) added a method for examining the legacy site:  Affixing ?WP=0 (adding WP set to 1 in the Querystring) will allow you to see the legacy version of the page you're on.

## Cloning the site
If you want to clone voluntaryist.com, that's fine. Obviously, you'll need your own domain name.  If you'd like a relativelty fresh copy of the database, please let me know (Dave).  We generally make a full backup of the site every three months.  I'll have to open it, scrub the passwords, and then send it to you.

## History
Below is some information about how this repo got started...

Here is the meat of exchanges between Steve, Dooglio, and Dave, so you have some background:

Here is a list of priorities as they sit in my head:

* A readme file or Wiki on the project (I guess I'd have to write it) that identifies important things that aren't obvious from looking at the files.  This has to be before the next one because there are odd things, like every request for an html file goes through index.php so that it can be restructured a bit.  Inefficient, I know, but I'm lazy so I wrote code to restructure pages instead of editing the pages.
* Either update newlay.php (which does the restructuring), or edit all the html pages to use divs instead of tables.  This is to make it easier to make the site more mobile friendly.
* See if bootstrap will take care of making the site mobile-friendly and if so, deploy a copy on a webserver for us to examine for a while.
    
Steve wrote:
    You'll need the git clone URL to checkout the project. It's located on the right hand side of the github project. When you make changes to the project after you clone it you "add" the changes and then "commit" what you added. After that you "push" the changes and that's what puts it back on github. Let me know if you have any questions, more than happy to help with this.
    
Dave wrote: I worry a bit that any team I lead will be kind of discouraged by my "try it and see" policy.  I am not confident in predicting the future, so I don't make many plans.  I like things to evolve.  However, if someone else outlines a plan and it looks good to me, I will follow along until and unless I see a problem.  Welcome to the mind of Dave :-)
