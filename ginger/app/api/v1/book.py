from flask import request

from app.libs.redprint import Redprint

api = Redprint('book')

@api.route('/getbook')
def get_book():
    data = request.json
    return 'get book'