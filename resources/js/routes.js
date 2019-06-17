import Home from './components/Home'
import ChatContainer from './components/ChatContainer'

export default {
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/chat',
            name: 'chat',
            component: ChatContainer,
            beforeEnter: (to,from,next) => {
                if(to.params.auth) {
                    next()
                }
                else {
                    console.log("Please Login to view this page")
                }
                
            }
        }
    ]
}