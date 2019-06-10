import Archive from './views/Archive';
import Kitchen from './views/Kitchen';

export const routes = [
	{
		path: '/order',
		name: 'Kitchen',
		component: Kitchen
	},
	{
		path: '/archive',
		name: 'Archive',
		component: Archive
	},
];
