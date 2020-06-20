import Dashboard from "./components/pages/Dashboard";
import Login from "./components/pages/Login";

export const routes = [
    {
        path:"/",
        component : Dashboard,
        meta: {
            requiresAuth: true
        }
    },
    {
        path:"/login",
        component : Login
    },
];
