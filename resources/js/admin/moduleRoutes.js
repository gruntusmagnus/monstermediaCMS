import {routes as catalog} from "../modules/Catalog/admin/routes.js"
import {routes as log} from "../modules/Log/admin/routes.js"
import {routes as order} from "../modules/Order/admin/routes.js"
import {routes as apivento} from "../modules/ApiVento/admin/routes.js"
import {routes as chat} from "../modules/Chat/admin/routes.js"
export const moduleRoutes = [].concat(catalog).concat(log).concat(order).concat(apivento).concat(chat);

// Generated at 2019-05-27T15:04:13+02:00
