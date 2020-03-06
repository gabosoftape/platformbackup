# -*- coding: utf-8 -*-
# from odoo import http


# class Bravo-fin-svg(http.Controller):
#     @http.route('/bravo-fin-svg/bravo-fin-svg/', auth='public')
#     def index(self, **kw):
#         return "Hello, world"

#     @http.route('/bravo-fin-svg/bravo-fin-svg/objects/', auth='public')
#     def list(self, **kw):
#         return http.request.render('bravo-fin-svg.listing', {
#             'root': '/bravo-fin-svg/bravo-fin-svg',
#             'objects': http.request.env['bravo-fin-svg.bravo-fin-svg'].search([]),
#         })

#     @http.route('/bravo-fin-svg/bravo-fin-svg/objects/<model("bravo-fin-svg.bravo-fin-svg"):obj>/', auth='public')
#     def object(self, obj, **kw):
#         return http.request.render('bravo-fin-svg.object', {
#             'object': obj
#         })
