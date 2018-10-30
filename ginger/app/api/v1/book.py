from flask import Blueprint

book = Blueprint('book',__name__)


@book.route('/v1/getBook')
def getBook():
    return 'get book'