from pymycobot.mycobot import MyCobot
import time
import math

mc = MyCobot('/dev/ttyAMA0',1000000)
amplitude=30
cycles=3
delay=0.1

# Start with a vertical posture
base_pose = [0, 0, 0, 0, 0, 0]
mc.send_angles(base_pose, 50)
time.sleep(2)

# Perform the wiggle
for c in range(cycles):
    for i in range(0, 360, 15):  # 15° increments through one sine wave
        # Generate smooth joint motions with sine pattern
        j2 = math.sin(math.radians(i)) * amplitude
        j3 = -math.sin(math.radians(i + 60)) * amplitude * 0.8
        j4 = math.sin(math.radians(i + 120)) * amplitude * 0.6
        j5 = -math.sin(math.radians(i + 180)) * amplitude * 0.4
        mc.send_angles([0, j2, j3, j4, j5, 0], 50)
        time.sleep(delay)

# Return to neutral pose
mc.send_angles(base_pose, 50)
time.sleep(1)