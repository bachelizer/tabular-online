const MainRoutes = {
    path: '/main',
    meta: {
        requiresAuth: true
    },
    redirect: '/main',
    component: () => import('@/layouts/full/FullLayout.vue'),
    children: [
        // {
        //     name: 'Dashboard',
        //     path: '/',
        //     component: () => import('@/views/dashboard/index.vue')
        // },
        {
            name: 'Typography',
            path: '/ui/typography',
            component: () => import('@/views/components/Typography.vue')
        },
        {
            name: 'Shadow',
            path: '/ui/shadow',
            component: () => import('@/views/components/Shadow.vue')
        },
        {
            name: 'Icons',
            path: '/icons',
            component: () => import('@/views/pages/Icons.vue')
        },
        {
            name: 'Starter',
            path: '/sample-page',
            component: () => import('@/views/pages/SamplePage.vue')
        },
        {
            name: 'Event',
            path: '/event',
            component: () => import('@/views/event/Index.vue')
        },
        {
            name: 'EventManagement',
            path: '/event/:id',
            component: () => import('@/views/event/Event.vue')
        },
        {
            name: 'JudgeEvent',
            path: '/judge',
            component: () => import('@/views/judge/MyEvent.vue')
        },
        {
            name: 'AnnouncementAndActivity',
            path: '/announcement-activity',
            component: () => import('@/views/announcement-activity/Index.vue')
        },
    ]
};

export default MainRoutes;
