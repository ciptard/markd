# Overview
### Current State
Please keep in mind that right now this project is still extremely alpha and nowhere near feature complete.  In its current state it wouldn't even be worth running on a site right now.  Anyhow, feel free to contribute or do your own thing with it :)

### What It Does 
The purpose of markd is to produce a static website and/or blog based off of a hierarchical structure of Markdown syntax files.

### Why Use It
One key advantage is simplicity of management.  If you need to add a new post, simply create a new markdown file and write.  If you need to add a new page, put a markdown file into the pages directory and it will be added to the menus and made into a nice HTML page.

Another advantage would be the sites ability to sustain load.  It's pretty simple, the site that is produced is static HTML.  Most modern web servers can serve static content at blazing fast speeds (we're talking 15k requests per second, if not more, under the right configuration).

### What it Does Not Do
At least for the time being, there is no dynamic processing.  This means comments aren't supported, and contact forms, etc aren't provided.  You could set up a contact form script on your own, or you could use a comment system like [Disqus](http://disqus.com/).  But markd doesn't provide it on its own.

---

# Questions?
**Q: Doesn't something like this already exist?**

A: Yep.  I've seen other PHP projects that do this, as well as Ruby projects.

**Q: Doesn't it bother you that you're creating something that already exists?**

A: Not really

**Q: So why did you build it?**

A: I really just wanted a system that worked the way *I* wanted it to.  It was also a bit of an exercise for me from an engineering perspective to sharpen a few skills I feel I'd gotten stale on.

**Q: Oh**

A: That's not a question.

**Q: I'm not a developer. Should I use this?**

A: Possibly not.  It requires using PHP-CLI.  That will need to be installed on the computer you generate your site from, and you'll need to put the path to PHP in one of the files.  PHP command line scripts aren't usually the best fit for non-developers.

**Q: I am a developer, should I use this?**

A: If you like the features, then sure.  Please contribute as well.  If you want it to do something vastly different then you might want to fork it or make your own.

---

# License & Copyright
**markd Copyright (C) 2012  Matthew Walters**

Please see GPLv3.txt for full license information.

This program comes with ABSOLUTELY NO WARRANTY. This is free software, and you are welcome to redistribute it under certain conditions. See the file GPLv3.txt for these warranty details and distribution conditions.