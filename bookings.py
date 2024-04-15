from flask import Flask, render_template
import pymysql

app = Flask(__name__)

# Configure the database connection
hostname = 'localhost'
username = 'root'
password = ''
database = 'adventours_nepal'

# Define a route to handle the bookings page
@app.route('/bookings')
def bookings():
    # Connect to the database
    conn = pymysql.connect(host=hostname, user=username, password=password, database=database)
    cursor = conn.cursor()

    # Query the database to retrieve bookings
    sql = "SELECT * FROM bookings ORDER BY id DESC"
    cursor.execute(sql)
    result = cursor.fetchall()

    if result:
        # Render the bookings template with the retrieved data
        return render_template('bookings.html', bookings=result)
    else:
        return 'No bookings available'

if __name__ == '__main__':
    app.run()




