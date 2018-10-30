from app.libs.redprint import Redprint


api = Redprint('book')

@api.route('/getBook')
def getBook():
    return 'get book'

