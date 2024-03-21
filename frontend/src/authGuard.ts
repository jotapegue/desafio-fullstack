import type { NavigationGuardNext, RouteLocationNormalized } from 'vue-router';
import store from '@/store';

function isAuthenticated(): boolean {
  return store.state.token !== null;
}

export function requireAuth(
  to: RouteLocationNormalized,
  from: RouteLocationNormalized,
  next: NavigationGuardNext
): void {
  if (isAuthenticated()) {
    next();
  } else {
    next({name: 'login'});
  }
}
