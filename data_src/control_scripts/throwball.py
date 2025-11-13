from pymycobot.mycobot import MyCobot
import time

mc = MyCobot('/dev/ttyAMA0', 1000000)
delay = 1
neutral = [0, 0, 0, 0, 0, 0]
pose1 = [90, 90, 0, 0, -90, 90]
pose2 = [90, 0, 0, 0, -90, 90]
pose3 = [90, -90, 0, 0, -90, 90]

mc.send_angles(neutral, 50)
time.sleep(delay)

mc.send_angles(pose1, 50)
time.sleep(delay)
mc.send_angles(pose2, 50)
time.sleep(delay)
mc.send_angles(pose3, 50)
time.sleep(delay)

mc.send_angles(neutral, 50)
time.sleep(delay)
