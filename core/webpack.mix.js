const mix = require("laravel-mix");


mix.options({
    cleanCss: {
        level: {
            1: {
                specialComments: "none",
            },
        },
    },
    postCss: [require("postcss-discard-comments")({ removeAll: true })],
    PurgeCss: true,
});


mix.js('./resources/js/app.js', '../asset/static/app/js')
    .sass('./resources/scss/app.scss', '../asset/static/app/css')
    .copy('./resources/json', '../asset/static/app/json')
    .sourceMaps()
    .version();

// mix.styles([], "./style.min.css");

// mix.scripts([], "./main.min.js");
