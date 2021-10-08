'use strict'

/** @typedef {import('@adonisjs/framework/src/Request')} Request */
/** @typedef {import('@adonisjs/framework/src/Response')} Response */
/** @typedef {import('@adonisjs/framework/src/View')} View */

/**
 * Resourceful controller for interacting with tutorials
 */
 const pathAuth =use('App/help/path')
 const pathA=new pathAuth()
const Tuturial=use('App/Models/Tutorial')
class TutorialController {
  /**
   * Show a list of all tutorials.
   * GET tutorials
   *
   * @param {object} ctx
   * @param {Request} ctx.request
   * @param {Response} ctx.response
   * @param {View} ctx.view
   */
  async index ({ request, response, view }) {
    //return Tuturial.all()
    //Verificar autrorização do recurso
if(pathA.authUrl(request.originalUrl(),request.method(),"/auth/test")==406)
{return response.status(406).send()
   // return response.redirect('back',{code:406})
 }
    else{
      return Tuturial.all()
    }

  }

  /**
   * Render a form to be used for creating a new tutorial.
   * GET tutorials/create
   *
   * @param {object} ctx
   * @param {Request} ctx.request
   * @param {Response} ctx.response
   * @param {View} ctx.view
   */
  async create ({ request, response, view }) {
  }

  /**
   * Create/save a new tutorial.
   * POST tutorials
   *
   * @param {object} ctx
   * @param {Request} ctx.request
   * @param {Response} ctx.response
   */
  async store ({ request, response }) {
    const t=new Tuturial()
    t.title=request.post().title
    t.description=request.post().description
    t.published=request.post().published
   await t.save()

   return true
  }

  /**
   * Display a single tutorial.
   * GET tutorials/:id
   *
   * @param {object} ctx
   * @param {Request} ctx.request
   * @param {Response} ctx.response
   * @param {View} ctx.view
   */
  async show ({ params, request, response, view }) {
  }

  /**
   * Render a form to update an existing tutorial.
   * GET tutorials/:id/edit
   *
   * @param {object} ctx
   * @param {Request} ctx.request
   * @param {Response} ctx.response
   * @param {View} ctx.view
   */
  async edit ({ params, request, response, view }) {
  }

  /**
   * Update tutorial details.
   * PUT or PATCH tutorials/:id
   *
   * @param {object} ctx
   * @param {Request} ctx.request
   * @param {Response} ctx.response
   */
  async update ({ params, request, response }) {
  }

  /**
   * Delete a tutorial with id.
   * DELETE tutorials/:id
   *
   * @param {object} ctx
   * @param {Request} ctx.request
   * @param {Response} ctx.response
   */
  async destroy ({ params, request, response }) {
  }
}

module.exports = TutorialController
