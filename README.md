# dps-post-image-extension
Extension to Display Posts Shortcode to pull first image from a post if the featured image does not exist

### Notes
---

I created this extension with the idea that it could be generic in the data returned. However, to get the code done in a timely fashion, it is tightly coupled with Boostrap 2.0 css. See below for some of the classes that are used on the output.

For my client's needs, I also had to change the css to have a height of 380px. I hope to make most of these configurable but for now they are hardcoded.

### Outputs
---

Currently the plugin will modify the `$output` of dps' `display_posts_shortcode_output` call to display something like:

```html
<ul class="thumbnails">
  <li class="span4 dps-thumbnail">
    <div class="thumbnail">
      <a href="http://some-wordpress-guid">
        <img src="http://first-or-featured-img.jpg" scale="0">
        <p>Some title</p>
      </a>
    </div>
  </li>
  <li class="span4 dps-thumbnail">
    <div class="thumbnail">
      <a href="http://some-wordpress-guid">
        <img src="http://first-or-featured-img.jpg" scale="0">
        <p>Some other title</p>
      </a>
    </div>
  </li>
</ul>
```
