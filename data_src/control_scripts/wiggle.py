from pymycobot.mycobot import MyCobot
import time

mc = MyCobot('/dev/ttyAMA0', 1000000)
cycles = 3
delay = 0.5
neutral = [0, 0, 0, 0, 0, 0]
mc.send_angles(neutral, 50)
time.sleep(1)

for c in range(cycles):

    mc.send_angles([0, 15, -30, 15, 0, 0], 50)
    time.sleep(delay)

    mc.send_angles([0, -15, 30, -15, 0, 0], 50)
    time.sleep(delay)

mc.send_angles(neutral, 50)