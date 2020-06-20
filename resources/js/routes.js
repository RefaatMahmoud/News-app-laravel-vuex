import Dashboard from "./components/pages/Dashboard";
import Login from "./components/pages/Login";
import MainNews from "./components/pages/news/MainNews";
import NewsList from "./components/pages/news/NewsList";
import NewsCreate from "./components/pages/news/NewsCreate";

export const routes = [
    {
        path: "/",
        component: Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: "/login",
        component: Login
    },
    {
        path: "/news",
        component: MainNews,
        children: [
            {
                path: "/",
                component: NewsList
            },
            {
                path: "create",
                component: NewsCreate
            }
        ]
    }
];
