def distance(strand_a, strand_b):
    if len(strand_a) != len(strand_b):
        raise ValueError("Left and right strands must be of equal length")

    distance = 0
    for a, b in zip(list(strand_a), list(strand_b)):
        if a != b:
            distance += 1

    return distance
