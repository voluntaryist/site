# site
voluntaryist.com website

The .htaccess shows that all .htm and .html files will be Mod-Rewritten to hit newlay.php which restructures them.

This is ugly in SourceTree because it won't wrap the long lines.  Suggestions?

Here is the meat of exchanges between Steve, Dooglio, and Dave, so you have some background:

Here is a list of priorities as they sit in my head:

    A readme file or Wiki on the project (I guess I'd have to write it) that identifies important things that aren't obvious from looking at the files.  This has to be before the next one because there are odd things, like every request for an html file goes through index.php so that it can be restructured a bit.  Inefficient, I know, but I'm lazy so I wrote code to restructure pages instead of editing the pages.
    Either update newlay.php (which does the restructuring), or edit all the html pages to use divs instead of tables.  This is to make it easier to make the site more mobile friendly.
    See if bootstrap will take care of making the site mobile-friendly and if so, deploy a copy on a webserver for us to examine for a while.
    
Steve wrote:
    You'll need the git clone URL to checkout the project. It's located on the right hand side of the github project. When you make changes to the project after you clone it you "add" the changes and then "commit" what you added. After that you "push" the changes and that's what puts it back on github. Let me know if you have any questions, more than happy to help with this.
    
Dave wrote: I worry a bit that any team I lead will be kind of discouraged by my "try it and see" policy.  I am not confident in predicting the future, so I don't make many plans.  I like things to evolve.  However, if someone else outlines a plan and it looks good to me, I will follow along until and unless I see a problem.  Welcome to the mind of Dave :-)