from app.libs.redprint import Redprint

api = Redprint('book')

@api.route('/getbook')
def get_book():
    return 'get book'