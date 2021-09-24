import barba from '@barba/core';
import { blogItemEnter, blogItemLeave, mainNavigationEnter, mainNavigationLeave, mainNavigationOnce } from './transitions';
import { page } from './default.js'

barba.hooks.enter(() => {
    window.scrollTo(0, 0);
})

barba.hooks.afterEnter(() => {
    page()
})

barba.init({
    timeout: 10000,
    // debug : true,
    prevent: function({ el }) {
        !el.dataset.trigger
    },
    'transitions': [
        {
            name: 'default',
            once() { 
                return mainNavigationOnce()
            },
            leave(){ 
                // console.log('default') 
            },
            enter(){}
        },
        {
            name: 'menu-nav',
            from: {
                custom: ({ trigger }) => {
                    return trigger.dataset && trigger.dataset.trigger == 'main-nav'
                }
            },
            leave({ current }) {
                return mainNavigationLeave( current.container );
            },
            enter({ current, next }) {
                return mainNavigationEnter( current, next );
            }

        },
        {
            name: 'blog-item',
            from: {
                custom: ({ trigger}) => {
                    return trigger.dataset && trigger.dataset.trigger == 'blog-item-transition';
                }
            },
            leave({ current, trigger }) {
                return blogItemLeave( current.container, trigger );
            },
            enter({ next }) {
                return blogItemEnter( next.container );
            }

        }
    ]
});