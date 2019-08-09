class ResistorColorDuo
  COLORS = %w[black brown red orange yellow green blue violet grey white]

  def self.value(bands)
    first, second = bands
    10 * COLORS.index(first) + COLORS.index(second)
  end
end
