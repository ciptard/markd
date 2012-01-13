# Foreword

Please keep in mind that right now this project is still extremely alpha and nowhere near feature complete.  In its current state it wouldn't even be worth running on a site right now.  Anyhow, feel free to contribute or do your own thing with it :)

---

# Overview
### What It Does 
The purpose of markd is to produce a static website and/or blog based off of a hierarchical structure of Markdown syntax files.

### Why Use It
One key advantage is simplicity of management.  If you need to add a new post, simply create a new markdown file and write.  If you need to add a new page, put a markdown file into the pages directory and it will be added to the menus and made into a nice HTML page.

Another advantage would be the sites ability to sustain load.  It's pretty simple, the site that is produced is static HTML.  Most modern web servers can serve static content at blazing fast speeds (we're talking 15k requests per second, if not more, under the right configuration).

### What it Does Not Do
At least for the time being, there is no dynamic processing.  This means comments aren't supported, and contact forms, etc aren't provided.  You could set up a contact form script on your own, or you could use a comment system like [Disqus](http://disqus.com/).  But markd doesn't provide it on its own.

---

# Road Map Of Upcoming Features
* Hierarchical menus produced based on the file system / directory structure
* Post formats (specific looks for Links, Status Updates, Images)
* Hook system for plugins/themes
* Child themes

---

# Versioning

Releases will be numbered with the following format:

`<major>.<major>.<patch>`

i.e. Version 2 is no bigger or more important than v1.9 or 1.2.  Patches/misc will be released with versions such as 1.2.1 to indicate it is a patch to 1.2.

---

# Contributing
On the [Issues page](https://github.com/mwalters/markd/issues), there are issues marked as "[blessed](https://github.com/mwalters/markd/issues?labels=blessed&sort=created&direction=desc&state=open&page=1)". These issues indicate items that are in-line with the core teams vision for the product. Assuming they receive a good change set, it will get committed to the project.

This does not mean that items missing the "blessed" tag will not be committed if someone does the work, and forks of the project are welcome and encouraged (why else would this be on github after all?). It is possible that with good work put towards any feature that it will be incorporated to the core product. However, if your intention is to get something committed to the core markd product, you might want to check with a core dev before doing the work.

---

# License & Copyright
**markd Copyright (C) 2012  Matthew Walters**

This program comes with ABSOLUTELY NO WARRANTY. This is free software, and you are welcome to redistribute it under certain conditions. See the file GPLv3.txt for these warranty details and distribution conditions.
