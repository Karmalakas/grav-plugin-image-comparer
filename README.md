# Image Comparer Plugin

**This README.md file should be modified to describe the features, installation, configuration, and general usage of the plugin.**

The **Image Comparer** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav). Compare three images using sliders

## Usage

**NB:** For plugin to work on Admin, [this PR](https://github.com/getgrav/grav-plugin-admin/pull/2159) needs to be merged

Plugin provides the default _Image-comparer_ template ready to use. If you use it, your page frontmatter could be:
```yaml
# image-comparer.md

title: Comparison
media_order: 'image_1.jpg,image_2.jpg,image_3.jpg,image_4.jpg,image_5.jpg'
image_comparers:
    -
        before:
          text: Before edit
          image: image_1.jpg
        middle:
          text: First edit
          image: image_2.jpg
        after:
          text: Final image
          image: image_3.jpg
    -
        before:
            text: null
            image: image_4.jpg
        middle:
            text: null
            image: null
        after:
            text: null
            image: image_5.jpg
```

If you decide to use your custom template, it should include `{{ image_comparer('.comparer-selector')|raw }}` (this adds CSS and initiates JS logic) and some HTML with specific structure. Example:
```html
{# custom-image-comparer.html.twig #}

{{ image_comparer('#list-holder>.comparer-wrapper')|raw }}

<div id="list-holder" class="comparers-holder">
    {% for comparer in page.header.image_comparers %}
        <div class="comparer-wrapper">
            <div class="comparer">
                <div class="slide-holder before">
                    <img src="{{ image_url }}" draggable="false" alt="Before"/>
                    <div class="caption">Before</div>
                </div>
                <div class="slide-holder middle">
                    <img src="{{ image_url }}" draggable="false" alt="Middle"/>
                    <div class="caption">Mid edit</div>
                </div>
                <div class="slide-holder after">
                    <img src="{{ image_url }}" draggable="false" alt="After"/>
                    <div class="caption">After</div>
                </div>
                <div class="scroller scroller-before" data-active-label="before"></div>
                <div class="scroller scroller-after" data-active-label="after"></div>
            </div>
        </div>
    {% endfor %}
</div>
```

If you decide to use plugin CSS and JS, all HTML elements attributes and CSS classes do matter. If you don't need the middle image, you should remove the `.slide-holder.middle` and `.scroller.scroller-after` elements.

## Installation

Installing the Image Comparer plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install image-comparer

This will install the Image Comparer plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/image-comparer`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `image-comparer`. You can find these files on [GitHub](https://github.com/karmalakas/grav-plugin-image-comparer) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/image-comparer
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/karmalakas/grav-plugin-image-comparer/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/image-comparer/image-comparer.yaml` to `user/config/plugins/image-comparer.yaml` and only edit that copy.

Note that if you use the Admin Plugin, a file with your configuration named image-comparer.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.
