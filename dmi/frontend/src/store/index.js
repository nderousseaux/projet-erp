import { createStore } from 'vuex';

import med from '@/store/med';
import login from '@/store/login';

const Store = createStore({
  modules: {
    med,
    login
  },
})

export default Store;