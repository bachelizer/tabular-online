import { ApertureIcon, CopyIcon, LayoutDashboardIcon, LoginIcon, MoodHappyIcon, TypographyIcon, UserPlusIcon } from 'vue-tabler-icons';

export interface menu {
    header?: string;
    title?: string;
    icon?: any;
    to?: string;
    chip?: string;
    chipColor?: string;
    chipVariant?: string;
    chipIcon?: string;
    children?: menu[];
    disabled?: boolean;
    type?: string;
    subCaption?: string;
    userRole?: string;
}

const sidebarItem: menu[] = [
    { header: 'Home' },
    // {
    //     title: 'Dashboard',
    //     icon: LayoutDashboardIcon,
    //     to: '/'
    // },
    // { header: 'utilities' },
    // {
    //     title: 'Typography',
    //     icon: TypographyIcon,
    //     to: '/ui/typography'
    // },
    // {
    //     title: 'Shadow',
    //     icon: CopyIcon,
    //     to: '/ui/shadow'
    // },
    // { header: 'auth' },
    // {
    //     title: 'Login',
    //     icon: LoginIcon,
    //     to: '/auth/login'
    // },
    // {
    //     title: 'Register',
    //     icon: UserPlusIcon,
    //     to: '/auth/register'
    // },
    // { header: 'Extra' },
    // {
    //     title: 'Icons',
    //     icon: MoodHappyIcon,
    //     to: '/icons'
    // },
    // {
    //     title: 'Sample Page',
    //     icon: ApertureIcon,
    //     to: '/sample-page'
    // },
    {
        title: 'Event',
        icon: ApertureIcon,
        to: '/event',
        userRole: 'Admin'
    },
    {
        title: 'Judge Event',
        icon: ApertureIcon,
        to: '/judge',
        userRole: 'Judge'
    },
    {
        title: 'Announcement And Activity',
        icon: ApertureIcon,
        to: '/announcement-activity',
        userRole: 'Admin'
    },
    {
        title: 'Announcement And Activity',
        icon: ApertureIcon,
        to: '/announcement-activity',
        userRole: 'Judge'
    }
];

export default sidebarItem;
