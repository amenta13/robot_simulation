from pymycobot.mycobot import MyCobot
import time

mc = MyCobot('/dev/ttyAMA0', 1000000)
cycles = 3
delay = 0.25
neutral = [0, 0, 0, 0, 0, 0]
adjustwrist = [0, 0, 0, 0, -90, 0]
mc.send_angles(neutral, 50)
time.sleep(1)
mc.send_angles(adjustwrist, 50)
time.sleep(1)

for c in range(cycles):

    mc.send_angles([0, 15, 15, 15, -90, 0], 50)
    time.sleep(delay)

    mc.send_angles([0, -15, -15, -15, -90, 0], 50)
    time.sleep(delay)

mc.send_angles(neutral, 50)