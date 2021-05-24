1. Measuring Tools for Web Pages:
    -Chrome Lighthouse (Local Chrome Browser)
    -PageSpeedInsights (https://developers.google.com/speed/pagespeed/insights/)
    -Web.Dev (https://web.dev/measure/)       
    -GTMatrix (https://gtmetrix.com/)
    -WebPageTest (https://www.webpagetest.org/)

2.Reading Waterfalls
    -Locally using Chrome
    -Using GTMatrix
    -Using WebPageTest

4. Critical Rendering Path

3.Web Metrics
    -First Contentful Paint (FCP)
    -Largest Contentful Paint (LCP)
    -Total Blocking Time (TBT)
    -Time to Interactive (TTI)
    -Cumulative Layout Shift (CLS)

6.Suggestions
    -Use of HTTP2/HTTP3 protocol instead of HTTP1
    -Image Optimization
        -Use .jpg instead of .png
        -Cut down extra size of the images (Thumbor  http://thumbor.org/) 
        -Use of Lazy Loading (set loading=lazy in img tag or use npm package/ Can be used to lazy load the iframe)
        -specify image and width attribute to avoid CLS
    -Use of async/defer attributes on script tag
    -Use of Text Compression (GZIP or Brotli)
    -Optimize CSS
        -Write mobile first CSS
        -do not nest it above 3 levels
        -extract critical css and inline it (use of npm critical package)
        -remove unused css (can be found in coverage tab)
    -optimize JS
        -bundle js in diffrent files
        -avoid nested for loops 
        -try to get linear time complexity or lower than that (O(n) ,O(1))
    -Optimize Fonts
        -Use of font-display: swap property
    -Caching of the unchanged assets (this can be done at server level)
