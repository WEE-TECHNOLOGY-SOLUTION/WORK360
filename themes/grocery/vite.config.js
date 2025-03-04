import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";



export default defineConfig({
    plugins: [
        laravel({
            input: [
                "themes/grocery/sass/app.scss",
                "themes/grocery/assets/js/jquery.min.js",
                "themes/grocery/assets/js/jquery-ui.js",
                "themes/grocery/assets/js/slick.min.js",
                "themes/grocery/assets/js/slick-lightbox.js",
                "themes/grocery/assets/js/custom.js",
                "themes/grocery/js/app.js"
            ],
            buildDirectory: "grocery",
        }),
        
        
        {
            name: "blade",
            handleHotUpdate({ file, server }) {
                if (file.endsWith(".blade.php")) {
                    server.ws.send({
                        type: "full-reload",
                        path: "*",
                    });
                }
            },
        },
    ],
    resolve: {
        alias: {
            '@': '/themes/grocery/js',
            '~bootstrap': path.resolve('node_modules/bootstrap'),
        }
    },
    
});
