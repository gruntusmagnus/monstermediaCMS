import CategoryIndex from './views/category/Index';
import CategoryDetail from './views/category/Detail';
import ProductIndex from './views/product/Index';
import ProductDetail from './views/product/Detail';

export const routes = [
	{
		path: '/category/:id?',
		name: 'CategoryIndex',
		component: CategoryIndex
	},
	{
		path: '/category/:id/edit',
		name: 'CategoryDetail',
		component: CategoryDetail
	},
	{
		path: '/product',
		name: 'ProductIndex',
		component: ProductIndex
	},
	{
		path: '/product/:id/edit',
		name: 'ProductDetail',
		component: ProductDetail
	},
];
