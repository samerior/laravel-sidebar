module.exports = {
    title: 'Laravel Sidebar',
    description: "A Laravel Sidebar generator",
    home: true,
    serviceWorker: true,
    head: [
        ['link', {rel: 'icon', href: `/icon.jpg`}]
    ],
    ga: 'UA-119008638-1',
    themeConfig: {
        repo: 'samerior/laravel-sidebar',
        // editLinks: true,
        nav: [
            {text: 'Home', link: '/'},
            {text: 'Samerior Group', link: 'https://www.samerior.com'}
        ],
        sidebar: [
            '/',
            ['/guide/introduction', 'Introduction'],
            ['/about', 'About Samerior Group'],
            {
                title: 'Get Started',
                collapsable: false,
                children: [
                    ['/guide/installation', 'Installation'],
                    ['/guide/building', 'Building the Sidebar'],
                    ['/guide/registering', 'Registering the Sidebar'],
                    ['/guide/rendering', 'Rendering the Sidebar'],
                    ['/guide/caching', 'Caching the Sidebar'],
                    ['/guide/extending', 'Extending the Sidebar']
                ]
            },
            ['/LICENSE', 'License'],
            {
                title: 'Contributing',
                children: [
                    ['/developers/contributing', 'Contributing'],
                    ['/developers/coc', 'Code of Conduct']
                ]
            }
        ]
    }
}
