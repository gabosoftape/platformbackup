# -*- coding: utf-8 -*-

from odoo import models, fields, api

class bravoFinMaintenance1(models.Model):
    _name = 'bf.svg.tp_operation'
    _description = 'Tipos de operación'

    description = fields.Char('Descripción')