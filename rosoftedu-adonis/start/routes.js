'use strict'

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Http routes are entry points to your web application. You can create
| routes for different URLs and bind Controller actions to them.
|
| A complete guide on routing is available here.
| http://adonisjs.com/docs/4.1/routing
|
*/

/** @type {typeof import('@adonisjs/framework/src/Route/Manager')} */
const Route = use('Route')
 

Route.get('/', () => {
  return { greeting: 'Hello world in JSON' }
})
Route.post("resgister","AuthController.resgister")
Route.post("authenticate","AuthController.authenticate")
Route.get("/app","AppController.index").middleware(['auth'])
Route.get("auth/show/:id","AuthController.show").middleware(['auth'])
Route.get("auth/test","AuthController.test")
Route.get("auth/sucesso","AuthController.sucesso")

Route.post("product/store","ProductController.store").middleware(['auth'])
Route.get("product/:id","ProductController.show")
Route.get("tutorial","TutorialController.index").middleware(['auth'])
Route.post("tutorial","TutorialController.store")
//Route.get("tutorial/edit/:id","TutorialController.show")